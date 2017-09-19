module.exports = {
  "env": {
    "browser": true,
    "es6": true
  },
  "extends": "eslint:recommended",
  "rules": {
    "no-console": ["warn"],
    "linebreak-style": [
      "error", "unix"
    ],
    // "no-undef": "off",
    "quotes": [
      "error", "single"
    ],
    "semi": ["error", "never"]
  },
  "parserOptions": {
    "sourceType": "module"
  }
};
