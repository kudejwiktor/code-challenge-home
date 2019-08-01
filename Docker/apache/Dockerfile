FROM httpd:2.4.33-alpine
RUN apk update; \
    apk upgrade;

COPY apache.conf /usr/local/apache2/conf/location-service.apache.conf
RUN echo "Include /usr/local/apache2/conf/location-service.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's#AllowOverride [Nn]one#AllowOverride All#' /usr/local/apache2/conf/httpd.conf