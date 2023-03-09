const { series, parallel } = require("gulp");
const run = require("gulp-run");


function migrate(){
    return run("php artisan migrate:fresh --seed").exec();
}

function server(){
    return run("npm run serve").exec();
}

function dev(){
    return run("npm run dev").exec();
}

exports.migrate = migrate;
exports.server = server;
exports.dev = dev;
exports.migrate_server = series(migrate, server);
exports.dev_server = parallel(dev, server);




