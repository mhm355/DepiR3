FROM eclipse-temurin:latest
WORKDIR /app
COPY ./spring-petclinic .
EXPOSE 8080
RUN ./mvnw package -DskipTests
ENTRYPOINT ["/bin/sh", "-c"]
CMD ["java -jar /app/target/*.jar"]