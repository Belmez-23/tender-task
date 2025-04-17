docker-local:
	export DOCKER_INTERNAL_IP="$(shell ip route | grep docker0 | awk '{print $$9}')"; \
	export PROJECT_NAME="tender-task"; \
	docker compose up --build -d