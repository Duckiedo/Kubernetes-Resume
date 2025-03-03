# Kubernetes Resume Challenge: Ecommerce Web App

This project was part of the **Kubernetes Resume Challenge**, which tasked me with using an ecommerce website to demonstrate my ability to manage containers and Kubernetes clusters. As an IT major at William Paterson University with experience in technical projects, this challenge pushed me to step outside my comfort zone and further fuel my passion for technology. It was an eye-opening experience that not only helped me grow as a technical professional but also as a problem-solver.

The goal of this project was to containerize and deploy an ecommerce web application using Kubernetes. The first step I took in building the Kubernetes-based ecommerce web app was to create a `Dockerfile` and use **Docker Compose** to containerize the application. This process helped me understand how Dockerfiles are written, built, and pushed. I then pulled the ecommerce image and modified my Dockerfile to use `php:7.4-apache` as the base image, temporarily exposing port 80 to connect to the image via localhost.

For deployment, I chose **Google Kubernetes Engine (GKE)** to create a Kubernetes cluster. I wrote a `deployment.yaml` file referencing the Docker image and defining the necessary environment variables for database connectivity. This was where I learned to use `kubectl get pods` to monitor the status of my pods and database. To expose the deployment externally, I created a LoadBalancer service, which allowed me to obtain an accessible external IP for the application.

Instead of manually containerizing the database, I used the **MariaDB** image and integrated it with an existing `db-load-script.sql` alongside a Kubernetes **ConfigMap**. During this process, I encountered issues with viewing the database on my website. To troubleshoot, I used **DBeaver** to connect directly to the database and identified that the environment variables were being overwritten by a line in the `index.php` file. I resolved this by changing how the file read the environment variables, no longer pulling them from the previously existing `.env` file.

To enhance the user experience, I added a **dark mode feature**. This involved modifying the PHP and CSS files and creating a ConfigMap with `FEATURE_DARK_MODE=true`. I updated my deployment to include this **ConfigMap** as an environment variable, enabling the dark mode feature for users.

Throughout the process, I gained a deeper appreciation for the efficiency and convenience that Kubernetes offers for professional web development. I used `kubectl scale deployment/ecommerce --replicas=6` to manage increased traffic and ensure the application could handle more users. Additionally, I performed a **rolling update** with `kubectl rollout status deployment/ecommerce` to demonstrate how Kubernetes enables seamless web updates with zero downtime. I also learned how to **rollback a deployment** using `kubectl rollout undo deployment/ecommerce` to revert to a previous state, making sure application data could be restored if needed. To further enhance the availability of the application, I added **liveness and readiness probes** to my `deployment.yaml`. These probes help automatically restart unresponsive pods and delay traffic to new pods until they are fully ready, increasing the application’s overall availability.

Throughout this project, I deepened my understanding of Kubernetes and containerized application management. It was an invaluable experience that not only taught me how to scale, troubleshoot, and enhance a production-grade web app but also helped me learn how to better manage time, collaborate with tools like kubectl, and solve complex issues in real-time.

## Technologies Used
This project involved several technologies including **Docker**, **Kubernetes** (specifically **Google Kubernetes Engine (GKE)**), **MariaDB**, **PHP**, **CSS**, and **DBeaver**. I also made extensive use of **ConfigMaps and Secrets** in Kubernetes for managing application configurations.

## Conclusion
The Kubernetes Resume Challenge was a pivotal project in my academic and professional journey. It helped me push my boundaries in understanding containerization and Kubernetes, while also allowing me to gain hands-on experience with cloud infrastructure and deployment tools. Kubernetes proved to be an essential tool in ensuring my application’s reliability and scalability, and I’m excited to continue exploring its full potential in future projects. 

---

### **Next Steps**
Looking ahead, future improvements for the project could include implementing a Continuous Integration/Continuous Deployment (CI/CD) pipeline with tools like **Jenkins**, **GitLab CI**, or **GitHub Actions**, and integrating monitoring and logging solutions like **Prometheus** and **Grafana** to track real-time application performance.
