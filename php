#!/bin/bash
# Run project on container php7.4
docker exec -it market_docker_php bash -c "$(printf ' %q' "$@")"
