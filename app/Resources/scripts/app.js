
import angular from 'angular';

import dtpStandings from './dtp/standings/standings.module';

angular.module('app',[dtpStandings])
    .run(() => {
        console.log('App running ...')
    });
