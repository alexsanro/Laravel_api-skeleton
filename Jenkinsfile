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
        stage('Test') {
            steps {
                script{
                    customImage.inside {
                        sh 'node --version'
                        sh 'svn --version'
                    }
                }
            }
        }
    }
}
