.PHONY: up build

up:
	$(MAKE) -C ./location-service build

build: up