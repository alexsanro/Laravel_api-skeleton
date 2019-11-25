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
                    customImage.inside("--network ${NETWORK}") {
                        sh(script: "gradle composer", label: "Composer install")
                        sh(script: "gradle generateEnvFile", label: "Generar .env")
                    }
                }
            }
        }
        stage('Database') {
            steps {
                script{
                    customImage.inside("--network ${NETWORK}") {                        
                        withCredentials([usernamePassword(credentialsId: 'database_credentials_ci', usernameVariable: 'DB_USERNAME', passwordVariable: 'DB_PASSWORD')]){
                            sh(script: "gradle cleanDatabase", label: "Composer")
                            sh(script: "gradle migrateDatabase", label: "Composer")
                        }
                    }
                }
            }
        }
        stage('Tests PHP') {
            steps {
                script{
                    customImage.inside("--network ${NETWORK}") {                        
                        withCredentials([usernamePassword(credentialsId: 'database_credentials_ci', usernameVariable: 'DB_USERNAME', passwordVariable: 'DB_PASSWORD')]){
                            sh(script: "gradle passportToken", label: "Token passport API")
                            sh(script: "gradle phpUnit", label: "Test phpUnit")
                        }
                    }
                }
            }
        }
        stage('SonarQube') {
            steps{
                script{
                    customImage.inside("--network ${NETWORK}") { 
                        withSonarQubeEnv('sonarqube') {
                            sh(script: "gradle sonarScanner", label: "Sonarqube scanner")
                        }
                    }
                }
            }
        }
    }
}
