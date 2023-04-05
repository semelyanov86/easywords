import { ConfigInterface } from './Config.interface';

// individual environments configs:
import configMock from './config-files/mock.json';
import configLocal from './config-files/local.json';
import configBeta from './config-files/beta.json';
import configLive from './config-files/live.json';

// return appropriate config based on env VUE_APP_CONFIG
let env: string = 'live'; /* by default we return the live configuration */

// if our env VUE_APP_CONFIG variable is set, get its value
if (import.meta && import.meta.env) {
    env = import.meta.env.MODE.trim().toLowerCase();
}

// example using strategy pattern:
// const configsMap: { [key: string]: ConfigInterface } = {
//   mock: configMock,
//   local: configLocal,
//   beta: configBeta,
//   live: configLive,
// }
// if (!configsMap[env]) {
//   throw Error(`Could not find config for VUE_APP_CONFIG key "${ env }"`)
// }
// export const config: ConfigInterface = configsMap[env]

// example with javascript Map()
export const configsMap: Map<string, ConfigInterface> = new Map<string, ConfigInterface>([
    ['mock', configMock],
    ['local', configLocal],
    ['development', configLocal],
    ['beta', configBeta],
    ['live', configLive],
    ['production', configLive],
]);

if (!configsMap.has(env)) {
    throw Error(`Could not find config for VUE_APP_CONFIG key "${env}"`);
}

export const config: ConfigInterface = configsMap.get(env) as ConfigInterface;
