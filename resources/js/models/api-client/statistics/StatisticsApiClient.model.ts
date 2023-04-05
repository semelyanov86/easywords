import { StatisticsApiClientInterface } from './StatisticsApiClient.interface';
import { StatisticsApiClientUrlsInterface } from './StatisticsApiClientUrls.interface';
import { StatisticsDataInterface } from '@/models/statistics/statisticsData.interface';
import { HttpClient, HttpRequestParamsInterface } from '../../http-client';
import { LoadedUserInterface } from '@/models/user/loadedUser.interface';

export class StatisticsApiClientModel implements StatisticsApiClientInterface {
    private readonly urls!: StatisticsApiClientUrlsInterface;

    constructor(urls: StatisticsApiClientUrlsInterface) {
        this.urls = urls;
    }

    fetchStatistics(): Promise<StatisticsDataInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.fetchStatistics,
            requiresToken: true,
        };

        return HttpClient.get<StatisticsDataInterface>(getParameters);
    }
}
