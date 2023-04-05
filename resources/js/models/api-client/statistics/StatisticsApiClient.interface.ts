import { StatisticsDataInterface } from '../../statistics/statisticsData.interface';

export interface StatisticsApiClientInterface {
    fetchStatistics: () => Promise<StatisticsDataInterface>;
}
