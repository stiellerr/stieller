import { src, dest } from "gulp";
import zip from "gulp-zip";
import { name } from "./package.json";
import del from "del";

export const compress = () => {
    del("packaged");
    return src([
        "**/*",
        "!.husky/**",
        "!node_modules/**",
        "!packaged/**",
        "!src/**",
        "!temp/**",
        "!.babelrc",
        "!.eslintrc.js",
        "!.gitignore",
        "!.prettierignore",
        "!.prettierrc",
        "!gulpfile.babel.js",
        "!package-lock.json",
        "!package.json",
        "!readme.txt",
        "!webpack.config.js"
    ])
        .pipe(zip(`${name}.zip`))
        .pipe(dest("packaged"));
};

export default compress;
