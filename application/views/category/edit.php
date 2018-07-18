<div>
    <label for="categoryNameEdit">Category:
        <input type="text" class="form-control" name="categoryNameEdit" id="categoryNameEdit" value="<?php echo $categoryName; ?>">
    </label>
    <label for="categoryAcronymEdit">Acronym:
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="categoryAcronymEdit" id="categoryAcronymEdit" value="<?php echo $categoryAcronym; ?>">
            <div class="input-group-append">
                <div class="btn btn-primary">
                    <i id="cmdSuggestAcronymEdit" class="mdi mdi-auto-fix"></i>
                </div>
            </div>
        </div>
    </label>
    <input type="hidden" name="categoryIdEdit" value="<?php echo $categoryId; ?>">
</div>

<script type="text/javascript">
$(document).ready(function()
{
  //Suggest an acronym by using the first letters of the category name
  $('#cmdSuggestAcronymEdit').click(function() {
      var toMatch = $('#categoryNameEdit').val();
      var result = toMatch.charAt(0).toUpperCase() + toMatch.charAt(1).toUpperCase();
    //test if the text has at least two words
      if (toMatch.match(/\s/g)) {
        result = toMatch.replace(/(\w)\w*\W*/g, function (_, i) {
          return i.toUpperCase();
        });
      }
      $('#categoryAcronymEdit').val(result);
  });
});
</script>