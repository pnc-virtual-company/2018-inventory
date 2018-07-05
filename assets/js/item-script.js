var hasPrivilege = document.currentScript.getAttribute('hasPrivilege') === 'true';
var baseUrl = document.currentScript.getAttribute('baseUrl');
$(document).ready(function() {

  // to make column reorder in table list item
  var t = $('#items').DataTable({
    order: [],
    "columnDefs": [{
      "targets": 10,
      "visible": false,
      "searchable": false
    }],
    colReorder: true,
    responsive: true,
    'ajax': {
      'type': 'GET',
      'url': `${baseUrl}items/showAllitems`, //access to controller for get data from database
      'dataType': 'json'
    },
    "colReorder": {
      fixedColumnsLeft: 1,
    },
    "dom": "Bfrtip",
    stateSave: true,
    "buttons": [{
      extend: 'colvis',
      columns: ':not(.permanent)'
    }]
  });
  resetFilter();
  showAllitems(); //call function to use

  // showAllitems function get data from database in items show in table
  function showAllitems() {
    // show spin waiting for the result by ajax
    $("#showdata").html('<tr> <td class="text-center text-info"colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i> Loading...</td></tr>');
    $.ajax({
      type: 'ajax',
      url: `${baseUrl}items/showAllitems`,
      async: true,
      dataType: 'json',
      success: function(data) {
        t.clear().draw(); //this funciton is for make a result don't have dupplicate result
        var n = 1; //variable for count number
        var i;
        var status = "";
        //validate for status available
        for (i = 0; i < data.length; i++) {
          let row = '';
          row += `${data[i].itemcodeid}&nbsp;`;
          //Show edit button for privileged users.
          row += privilegedItem(() =>
            `<a href="${baseUrl}items/edit/${data[i].iditem}" class="item-edit" dataid="${data[i].iditem}" data-toggle="tooltip" title="Edit item" ><i class="mdi mdi-pencil"></i></a >
                  <a href="#" class="item-delete text-danger" dataid="${data[i].iditem}"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete item"></i></a>`
          );
          row += '&nbsp;<a href="#" class="item-view" dataid="' + data[i].iditem + '" data-toggle="tooltip" title="Show item detail"><i class="mdi mdi-eye text-primary"></i></a>';
          if (data[i].status === '0') {
            //Status available.
            row += `&nbsp;<a href="${baseUrl}items/borrower/${data[i].iditem}" class="item" dataid="${data[i].iditem}"><i class="mdi mdi-cart-outline" id="borrow" data-toggle="tooltip" title="Borrow"></i></a>`;
            status = '<span class="badge badge-success">Available</span>';
          } else if (data[i].status === '1') {
            //Status Borrowed
            row += privilegedItem(() =>
              `&nbsp;<a href="${baseUrl}items/returnItem/${data[i].iditem}"
                      class="item" dataid="${data[i].iditem}"><i class="mdi mdi-redo-variant" id="return"
                          data-toggle="tooltip" title="Return"></i></a >`
            );
            status = '<span class="badge badge-warning">Borrowed</span>';
          } else if (data[i].status === '2') {
            //Status late
            row += privilegedItem(() =>
              `&nbsp;<a href="${baseUrl}items/returnItem/${data[i].iditem}"
                      class="item" dataid="${data[i].iditem}"><i class="mdi mdi-redo-variant" id="return"
                          data-toggle="tooltip" title="Return"></i></a >`
            );
            //If privileged user ? Late : Borrowed.
            status = hasPrivilege ?
              '<span class="badge badge-danger">Late</span>' :
              '<span class="badge badge-warning">Borrowed</span>';
          }

          t.row.add([
            row,
            data[i].item, data[i].cat, data[i].mat, data[i].condition, data[i].depat, data[i].locat, data[i].nameuser, data[i].owner, status, data[i].date
          ]).draw(false);
          n++;
        }
      },
      error: function() {
        alert('Could not get Data from Database');
      }
    });
  }

  //  Combine btn onclick OK with key Enter when delete
  $('#deleteModal').keypress(function(e) {
    if (e.which === 13) { //Enter key pressed
      e.preventDefault();
      $('#delete-comfirm').click(); //Trigger search button click event
    }
  });

  // delete item by ajax when click on icon delete
  $('#showdata').on('click', '.item-delete', function() {
    var id = $(this).attr('dataid');
    $('#deleteModal').data('id', id).modal('show');
  });

  // load modal confirmation when click delete icon
  $("#delete-comfirm").on('click', function() {
    var id = $('#deleteModal').data('id');
    $.ajax({
      url: `${baseUrl}items/deleteItems`, // access to controller to delete from database
      type: "POST",
      data: {
        iditem: id
      },
      dataType: "json",
      success: function(data) {
        $('#deleteModal').modal('hide');
        //alert message when delete successfully
        $('.alert-info').html('Item was deleted successfully').fadeIn().delay(4000).fadeOut('slow');
        showAllitems();
      },
      error: function() {
        $('#deleteModal').modal('hide');
        alert("Error delete! this item is has relationship with another...");
      }
    });
  });

  // load modal for show the detail an item when click on eye icon to show detail of each item that clicked
  $('#showdata').on('click', '.item-view', function() {
    var id = $(this).attr('dataid');
    $.ajax({
      type: 'POST',
      data: {
        iditem: id
      },
      url: `${baseUrl}/items/showDetailItem`, //access to controller to get all the detail item from database
      async: true,
      dataType: 'json',
      success: function(data) {
        // $('#frm_view').html(data);
        $('#detail-name').html(data.name);
        $('#detail-description').html(data.description);
        $('#detail-label').html(data.code);
        $('#detail-cost').html(data.cost ? data.cost : 0);
        $('#detail-condition').html(data.condition);
        $('#detail-type').html(data.cat);
        $('#detail-brand').html(data.brand);
        $('#detail-model').html(data.model);
        $('#detail-material').html(data.mat);
        $('#detail-location').html(data.locat);
        $('#detail-department').html(data.depat);
        $('#detail-username').html(data.nameuser);
        $('#detail-owner').html(data.owner);
        $('#detail-status').html(data.status);
        $('#viewDetailModal').modal('show');
      },
      error: function() {
        alert('Could not get any data from Database');
      }
    });
  });



  $("#clearFilter").click(function() {
    $('#inputFilter').html('');
    filterTable();
  });

  $("#formfilter").on("click", "i.remove_filter", function() {
    $(this).parent().fadeOut('slow', function() {
      $(this).remove();
      filterTable();
    });
  });

  $("#addFilter").click(function() {
    $('#filteradd').modal('show');
  });

  $("#select_category").click(function() {
    $.ajax({
      type: 'POST',
      url: `${baseUrl}category/showAllCategory`,
      async: true,
      dataType: 'json',
      success: function(data) {
        $('#selectCategory').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#category').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for (i = 0; i < data.length; i++) {
          c.row.add([
            data[i].category
          ]).draw(false);
          n++;
        }
      },
      error: function() {
        alert('Could not get Data from Database');
      }
    });
  });

  var valueFilter = '';
  $(document).on("click", "#category tbody tr", function() {
    $('#category tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Category: ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectCategory").modal("hide");
    filterTable();
  });


  // material function
  $("#select_material").click(function() {
    $.ajax({
      type: 'POST',
      url: `${baseUrl}materials/showAllMaterial`,
      async: true,
      dataType: 'json',
      success: function(data) {
        $('#selectMaterial').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#material').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for (i = 0; i < data.length; i++) {
          c.row.add([
            data[i].material
          ]).draw(false);
          n++;
        }
      },
      error: function() {
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#material tbody tr", function() {
    $('#material tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Material: ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectMaterial").modal("hide");
    filterTable();
  });

  // select condition function
  $("#select_condition").click(function() {
    $('#conditionModal').modal('show');
    $('#filteradd').modal('hide');
  });
  $('.conditionList li').click(function() {
    $('.conditionList li').removeClass("highlight");
    $(this).addClass("highlight");
    var valueFilter = $(this).attr("value");
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Condition: ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#conditionModal").modal("hide");
    $('.conditionList li').removeClass("highlight");
    filterTable();
  })

  //select department function
  $("#select_department").click(function() {
    $.ajax({
      type: 'POST',
      url: `${baseUrl}departments/showAllDepartments`,
      async: true,
      dataType: 'json',
      success: function(data) {
        $('#selectDepartment').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#department').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for (i = 0; i < data.length; i++) {
          c.row.add([
            data[i].department
          ]).draw(false);
          n++;
        }
      },
      error: function() {
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#department tbody tr", function() {
    $('#department tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Department: ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectDepartment").modal("hide");
    filterTable();
  });


  // location function
  $("#select_location").click(function() {
    $.ajax({
      type: 'POST',
      url: `${baseUrl}locations/showAlllocat`,
      async: true,
      dataType: 'json',
      success: function(data) {
        $('#selectLocation').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#location').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for (i = 0; i < data.length; i++) {
          c.row.add([
            data[i].location
          ]).draw(false);
          n++;
        }
      },
      error: function() {
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#location tbody tr", function() {
    $('#department tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Location: ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectLocation").modal("hide");
    filterTable();
  });


  // user function
  $("#select_user").click(function() {
    $.ajax({
      type: 'POST',
      url: `${baseUrl}users/showAllUsers`,
      async: true,
      dataType: 'json',
      success: function(data) {
        $('#selectUser').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#user').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for (i = 0; i < data.length; i++) {
          c.row.add([
            data[i].firstname + ' ' + data[i].lastname
          ]).draw(false);
          n++;
        }
      },
      error: function() {
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#user tbody tr", function() {
    $('#user tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">User: ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectUser").modal("hide");
    filterTable();
  });

  // owner function
  $("#select_owner").click(function() {
    $.ajax({
      type: 'POST',
      url: `${baseUrl}owner/showAllOwner`,
      async: true,
      dataType: 'json',
      success: function(data) {
        $('#selectOwner').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#owners').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for (i = 0; i < data.length; i++) {
          c.row.add([
            data[i].owner
          ]).draw(false);
          n++;
        }
      },
      error: function() {
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#owners tbody tr", function() {
    $('#owners tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Owner: ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectOwner").modal("hide");
    filterTable();
  });


  // select condition function
  $("#select_date").click(function() {
    $('#dateModal').modal('show');
    $('#filteradd').modal('hide');
  });
  $('#saveDate').click(function() {
    var dateValCondition = $('#conditionDate').val();
    var valueFilter = $('#datecondition').val();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Date: ' + dateValCondition + ' ' + valueFilter + '&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $('#datecondition').val('');
    $("#dateModal").modal("hide");
    filterTable();
  })

  // date picker
  $('.datepicker').datepicker({
    orientation: "bottom",
    todayBtn: true,
    todayHighlight: true,
    autoclose: true,
  });

  // Date managment.
  $.fn.dataTableExt.afnFiltering.push(
    function(oSettings, data, iDataIndex) {
      console.log('data', data);
      // if (typeof aData._date == 'undefined') {
      //   aData._date = new Date(aData[0]).getTime();
      // }
      //
      // if (minDateFilter && !isNaN(minDateFilter)) {
      //   if (aData._date < minDateFilter) {
      //     return false;
      //   }
      // }
      return true;
    }
  );

  function filterTable() {
    resetFilter();
    let filters = $('#inputFilter > span').toArray().map(e => e.textContent);
    filters.forEach(filter => {
      let [constrainst, value] = filter.split(':');
      if (constrainst !== 'Date') {
        t.column(`:contains(${constrainst})`).search(value.trim()).draw();
      }
    });
  }

  function resetFilter() {
    t.columns().every(function() {
      this.search('');
    });
    t.draw();
  }

});

function privilegedItem(itemCallback) {
  return hasPrivilege ? itemCallback() : '';
}
