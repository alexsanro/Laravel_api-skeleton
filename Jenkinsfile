pipeline {
    agent any
    environment {
        DB_HOST = 'mysql_db_dev_tools'
        DB_DATABASE = 'api_database'
    }
    stages {
        stage('Docker'){
            steps{
                script {
                    def dockerfile='Dockerfile'
                    customImage=docker.build("my-image", "./tools") 
                }
            }
        }
        stage('Build') {
            steps {
                script{
                    customImage.inside {
                        withCredentials([usernamePassword(credentialsId: 'database_credentials_ci', usernameVariable: 'DB_USER', passwordVariable: 'DB_PASSWORD')]){
                            sh(script: "gradle cleanDatabase", label: "Composer")
                        }
                    }
                }
            }
        }
    }
}
