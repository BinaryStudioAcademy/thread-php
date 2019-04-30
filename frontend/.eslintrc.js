module.exports = {
    root: true,
    env: {
        node: true,
    },
    extends: [
        'plugin:vue/strongly-recommended',
        '@vue/airbnb',
    ],
    rules: {
        'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'vue/html-indent': ['error', 4],
        'vue/max-attributes-per-line': ['error', {
            singleline: 3,
            multiline: {
                max: 1,
                allowFirstLine: false,
            },
        }],
        indent: [
            'error',
            4,
        ],
        'linebreak-style': [
            'error',
            'unix',
        ],
        quotes: [
            'error',
            'single',
        ],
        semi: [
            'error',
            'always',
        ],
        'arrow-parens': 'off',
        'no-param-reassign': 'off',
        'vue/singleline-html-element-content-newline': 'off',
        'comma-dangle': 'off',
        'import/prefer-default-export': 'off',
        'max-len': ['error', {
            'code': 120,
            'tabWidth': 4
        }]
    },
    parserOptions: {
        parser: 'babel-eslint',
    },
};
