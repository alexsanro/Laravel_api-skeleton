FROM ubuntu:18.04
RUN apt-get update -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y tzdata && \
    apt-get install -y php7.2 php7.2-xml php7.2-mysql php-mbstring zip curl npm php7.2-xdebug openjdk-8-jdk wget mysql-client
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN curl --insecure -o ./sonarscanner.zip -L https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-3.0.3.778-linux.zip && \
    unzip sonarscanner.zip && \
    rm sonarscanner.zip && \
    mv sonar-scanner-3.0.3.778-linux /usr/lib/sonar-scanner && \
    ln -s /usr/lib/sonar-scanner/bin/sonar-scanner /usr/local/bin/sonar-scanner

RUN wget -q https://services.gradle.org/distributions/gradle-5.6-bin.zip \
    && unzip gradle-5.6-bin.zip -d /opt \
    && rm gradle-5.6-bin.zip

# Set Gradle in the environment variables
ENV GRADLE_HOME /opt/gradle-5.6
ENV PATH $PATH:/opt/gradle-5.6/bin

WORKDIR /usr/local/bin
RUN curl -L https://repo1.maven.org/maven2/org/flywaydb/flyway-commandline/6.0.6/flyway-commandline-6.0.6.tar.gz -o flyway-commandline-6.0.6.tar.gz \
  && tar -xzf flyway-commandline-6.0.6.tar.gz --strip-components=1 \
  && rm flyway-commandline-6.0.6.tar.gz

WORKDIR /app
