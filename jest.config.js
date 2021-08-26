module.exports = {
    setupFiles : ["./setup-jest.js"],
    // Where are your vue tests located?
    "roots": [
        "<rootDir>/resources/js/tests"
    ],
    transform: {
        '^.+\\.vue$': 'vue-jest',
    },
    preset: '@vue/cli-plugin-unit-jest'
}
