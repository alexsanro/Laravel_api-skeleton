pipeline {
    agent any
    stages {
        stage('Docker'){
            steps{
                def dockerfile='Dockerfile'
                def customImage=docker.build("my-image:${env.BUILD_ID}", "-f ${dockerfile} ./tools") 
            }
        }
        stage('Test') {
            steps {
                docker.image('my-image').inside {
                    sh 'node --version'
                    sh 'svn --version'
                }
            }
        }
    }
}