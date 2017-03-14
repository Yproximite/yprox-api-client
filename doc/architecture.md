# Architecture

![Data flow](./images/data_flow.png)

### Message

Message represents a data to be sent to an endpoint. Message could contain other messages.

### Service

Service is a class whose methods are implementation of endpoints.
Those methods normally receives messages and returns models.

### Model

Model represents a response from an endpoint.

### Client

Client is used by services to send messages via http.
