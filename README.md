# Ticket Tailor Technical Test (aka T4)

## Requirements
- Docker
- Make (Optional)

The entire demo is designed to work within a Docker container to avoid using system PHP and PECL requirements.

## Composer Token
It is very bad practice to leave an `auth.json` file around, but solving how to create this easily for a technical test in three hours is tricky. This one is good for 48 hours. Be nice.
If it stops working for any reason, please create a new token at https://github.com/settings/tokens/new?scopes=&description=Barney+T4 and then change the contents of auth.json

## Running the app
The easiest way to run the app is with the command `make run`. You can achieve the same with `docker compose up`.

Note this builds the image and install dependencies so this can take a while.

## Design Flaws

Three hours goes faster than expected. I wanted to demonstrate a PHP microservice created with a Domain-Driven Design (DDD) approach. A lot of this is based off the skeletons I have created in previous roles, so I first had to update my skeleton to work.

Favouring working software over well-tested yet unworking, I have had to prioritize getting the task done :(

You can see the resultant tests by running `make test`.

### Things I Want To Do

- Go back to playing with `amphp` so that the HTTP calls are in parallel and still have a backoff strategy.
- Test coverage back up to where it should be after I went down the async rabbit hole.
- Document the requirements in Gherkin format in the `/features` directory.

I am *really* not happy with the test coverage, but three hours is three hours.
