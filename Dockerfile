FROM PHP:Latest

RUN mkdir /covidstat/index.php

WORKDIR /covidstat/index.php

CMD [ "php", "./index.php" ]