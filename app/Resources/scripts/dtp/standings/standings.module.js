
import angular from 'angular';

const moduleName = 'dtp.standings';

angular.module(moduleName, [])
    .run(() => {
        console.log('Dtp standings loaded ...')
    });

export default moduleName;
