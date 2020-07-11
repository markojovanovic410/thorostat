import { Injectable } from '@angular/core';

@Injectable()
export class Configuration {
    // dev
    private server = 'http://127.0.0.1:8000/';

    // production
    // private server = 'http://api.thorostat.com/';

    private apiUrl = 'api/';

    public baseUrl = this.server + this.apiUrl;
    public STORAGE_BASE_URL = this.server;

}
