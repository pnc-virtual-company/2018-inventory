pipeline {
  agent any
  options{
    buildDiscarder(logRotator(artifactNumToKeepStr: '5', numToKeepStr: '5'))
  }
  // triggers {
  //   pollSCM('H/15 7-20 * * *')
  // }
  stages {
    stage('Init') {
      steps {
        script {
          if (isUnix()) {
            sh "rm -rf vendor 2>nul"
          } else {
            bat 'if exist vendor rmdir /s /q vendor'
          }
        }
      }
    }
    stage('Build') {
      steps {
        script {
          if (isUnix()) {
            sh "composer install"
          } else {
            bat 'composer install'
          }
        }
      }
    }
    stage('Checkstyle') {
      steps {
        script {
          if (isUnix()) {
            sh 'vendor/bin/phpcs -q --report=checkstyle --report-file=reports/checkstyle.xml'
          } else {
            bat 'vendor/bin/phpcs -q --report=checkstyle --report-file=reports/checkstyle.xml'
          }
        }
      }
      post {
        always {
          script {
            if (isUnix()) {
              sh 'cat reports/checkstyle.xml'
            } else {
              bat 'type reports\\checkstyle.xml'
            }
          }
          checkstyle canComputeNew: false, canRunOnFailed: true, defaultEncoding: '', healthy: '', pattern: 'reports/checkstyle.xml', unHealthy: ''
        }
      }
    }
    stage('Archiving') {
      steps {
        archiveArtifacts artifacts: 'src/**', fingerprint: true, onlyIfSuccessful: true
      }
    }
  }
}
