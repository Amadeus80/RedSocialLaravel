const { series, parallel } = require("gulp");
const run = require("gulp-run");

/* Realiza una migracion y un seeder */
function migrate(){
    return run("php artisan migrate:fresh --seed").exec();
}

/* Arranca el servidor */
function server(){
    return run("npm run serve").exec();
}

/* Arranca el servidor de vite */
function dev(){
    return run("npm run dev").exec();
}

exports.migrate = migrate;
exports.server = server;
exports.dev = dev;

exports.migrate_server = series(migrate, server);
exports.dev_server = parallel(dev, server);




