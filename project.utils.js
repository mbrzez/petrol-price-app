const path = require('path');
const projectDir = path.resolve(__dirname);

let contactToDir = (basedir, subdir) => basedir + '/' + subdir;
let resolveProjectDir = (subdir) => contactToDir(projectDir, subdir);

module.exports.resolveProjectDir = resolveProjectDir;