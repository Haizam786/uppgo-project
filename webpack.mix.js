const mix = require('laravel-mix');
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */


mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');


mix.js("resources/js/src/main.js", "public/js")
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "resources/js/src/"),
                "@themeConfig": path.resolve(
                    __dirname,
                    "resources/js/theme.config.js"
                ),
            },
        },
        module: {
            rules: [{
                test: /\.s[ac]ss$/i,
                use: [{
                    loader: "sass-loader",
                    options: {
                        sassOptions: {
                            includePaths: [
                                "node_modules",
                                "resources/js/src/assets",
                            ],
                        },
                    },
                }, ],
            }, ],
        },
    })
    .override((webpackConfig) => {
        webpackConfig.module.rules.forEach((rule) => {
            if (
                rule.test.toString() ===
                "/(\\.(png|jpe?g|gif|webp|avif)$|^((?!font).)*\\.svg$)/"
            ) {
                if (Array.isArray(rule.use)) {
                    rule.use.forEach((ruleUse) => {
                        ruleUse.options.esModule = false;
                        ruleUse.options.name =
                            "images/[path][name]-[hash].[ext]";
                        ruleUse.options.context =
                            "resources/js/src/assets/images";
                    });
                }
            }
        });
    })
    .sass("resources/js/src/assets/sass/app.scss", "public/css")
    .vue({ version: 2 })
    .version();

mix.js('resources/react/main.jsx', 'public/js/react-app.js')
    .react();

mix.postCss('resources/react/index.css', 'public/css/react-app.css', [
    require('tailwindcss'),
    require('autoprefixer'),
]);


mix.webpackConfig({
    output: {
        chunkFilename: "js/chunks/[name].[chunkhash].js",
    },
    resolve: {
        extensions: ['.js', '.jsx', '.vue'],
    },
});