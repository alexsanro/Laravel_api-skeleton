pipeline {
    agent any
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
                        sh("gradle cleanDatabase", label: "Composer")
                    }
                }
            }
        }
    }
}