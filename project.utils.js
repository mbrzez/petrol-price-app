const path = require('path');

const projectDir = path.resolve(__dirname);

let contactToDir = (basedir, subdir) => {
    return basedir + '/' + subdir;
};

let resolveProjectDir = (subdir) => {
    return contactToDir(projectDir, subdir)
};


module.exports = { resolveProjectDir };