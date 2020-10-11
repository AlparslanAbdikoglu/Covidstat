FROM PHP:Latest

RUN mkdir /covidstat/index.php

WORKDIR /covidstat/index.php

EXPOSE 3000

CMD [ "php", "./index.php" ]