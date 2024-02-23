# CONTAINERIZATION OF APPLICATIONS USING DOCKER AND LOAD SCALING USING KUBERNETES
### Introduction

• Containerization of Apps – Rapidly growing trend in modern software development. 

• Software Independence - Apps that run in any platform need not to be compatible with all platforms.Thus, need to install compatible OS. This is tedious and consumes time.

• Docker – Open source platform to create, deploy, and run applications in containers. Avoids OS installation.

• Kubernetes – Orchestration engine that resolves node traffic by HPA (Horizontal Pod Autoscaler).

• HPA – Automatically deploy more pods if load increases. 

---
### Objective 

• To make applications to be OS independent, 
portable and easy deployable into containers 
using Docker. Users can just pull the image 
from registry and work on their host machine.    

• To scale the pods up/down according to user 
traffic using Kubernetes – Load Scaling

----
### Proposed Architecture

![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/5cc1f645-9819-4522-bd57-dd7d54796d64)

![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/6b57d4ca-48ca-41fd-b1da-caf5dee8e9c0)

---
### Implementation 
#### CONTAINERIZATION OF APPLICATIONS USING DOCKER

1) Create an application with backend connectivity using MySql, Python, JavaScript, NodeJS etc.

2) Write the Dockerfile : Create a Dockerfile that defines the steps required to build your application image.

3) Build the Docker image : Use the `docker build` command to build your Docker image.

4) Test the Docker image : Run your Docker image as a container to test it thoroughly.

5) Push the Docker image to a registry : Once you are satisfied with your Docker image, push it to a registry like Docker Hub, so others can use it.

6) Deploy the Docker image : Use the `docker run` command to deploy your Docker image as a container on any host or cloud platform that supports Docker.
#### LOAD SCALING USING KUBERNETES
7) Define the deployment and service for your application.

8) Create a `HorizontalPodAutoscaler (HPA)` resource with the desired minimum and maximum number of replicas.

9) Set the metrics to be used for scaling the application (Node/User traffic).

10) Set the target average value for the metric. The HPA will scale the number of replicas up or down to maintain this average value.

11) Deploy the HPA resource to the Kubernetes cluster.

12) Monitor the application's performance and adjust the HPA settings as needed to ensure optimal performance.

---

### Output - Images


![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/153059ad-9166-4a00-9fb6-90762ebedb1c)
![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/79347306-4618-4c1e-815f-fe5dfefc719e)
![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/47336949-7e0a-4202-973f-86bda0519ddf)
![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/266c6f41-7e29-4ed6-a090-77e8b6620967)
![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/906385be-6de7-4f20-b7aa-23d3b87a4b08)
![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/e73fc2da-1b0f-47ef-8c60-c8821f217ce0)
![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/8fdd781a-dd9a-4f27-9864-ee12f1fbaa0c)
![image](https://github.com/Ashwanth-R/Containerization-of-Application-using-Docker-and-Kubernetes/assets/96193365/c9064420-c665-4045-901d-28ab19cbfe09)

---









