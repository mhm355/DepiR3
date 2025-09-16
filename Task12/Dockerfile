FROM eclipse-temurin:17-jdk-alpine AS builder
WORKDIR /app

# Copy Maven wrapper files AND pom.xml
COPY ./spring-petclinic_files/pom.xml ./
COPY ./spring-petclinic_files/mvnw ./
COPY ./spring-petclinic_files/.mvn ./.mvn

# Make mvnw executable
RUN chmod +x ./mvnw

# Download dependencies (this will be cached)
RUN ./mvnw dependency:go-offline -B

# Copy source code and build
COPY ./spring-petclinic_files/src ./src
RUN ./mvnw package -DskipTests

FROM eclipse-temurin:17-jre-alpine
WORKDIR /app
COPY --from=builder /app/target/*.jar /app/app.jar
EXPOSE 8080
CMD ["java", "-jar", "app.jar"]
