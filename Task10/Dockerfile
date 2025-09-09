FROM eclipse-temurin:17-jdk AS builder
WORKDIR /app
COPY ./spring-petclinic_files .
RUN ./mvnw package -DskipTests

FROM eclipse-temurin:17-jre
WORKDIR /app
COPY --from=builder /app/target/*.jar /app/app.jar
EXPOSE 8080
CMD ["java", "-jar", "app.jar"]
