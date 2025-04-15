const path = require("path");

module.exports = {
  watch: true,
  entry: {
    main: "./src/index.js",    // Entrée pour ton JS principal
    style: "./src/style.js",   // Entrée pour ton fichier SCSS
  },
  mode: "production",
  output: {
    filename: "[name].bundle.js",   // Créera main.bundle.js et style.bundle.js
    path: path.resolve(__dirname, "dist"),  // Dossier de sortie (./dist)
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,  // Gestion des fichiers SCSS
        use: [
          "style-loader",  // Injecte le CSS dans le DOM
          "css-loader",    // Interprète les fichiers CSS
          "sass-loader",   // Compiles les fichiers SCSS en CSS
        ],
      },
      {
        test: /\.js$/,    // Gestion des fichiers JS
        exclude: /node_modules/,
      },
    ],
  },
  resolve: {
    alias: {
      // Alias pour des imports simplifiés si besoin
      '@isotope': path.resolve(__dirname, 'node_modules/isotope-layout'),
    },
  },
};
