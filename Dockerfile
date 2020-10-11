FROM PHP:Latest

RUN mkdir -p /covidstat/index.php

WORKDIR /covidstat/index.php

EXPOSE 3000

CMD [ "php", "./index.php" ]