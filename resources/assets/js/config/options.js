const petrolStations = [
    {
        value: 27, desc: "Auchan Białystok Hetmańska"
    },
    {
        value: 28, desc: "Auchan Białystok Produkcyjna"
    },
    {
        value: 29, desc: "Auchan Bielsko-Biała"
    },
    {
        value: 16, desc: "Auchan Bydgoszcz Fordon"
    },
    {
        value: 31, desc: "Auchan Częstochowa Poczesna"
    },
    {
        value: 38, desc: "Auchan Gdańsk Szczęśliwa"
    },
    {
        value: 40, desc: "Auchan Gliwice"
    },
    {
        value: 50, desc: "Auchan Kraków Bonarka"
    },
    {
        value: 52, desc: "Auchan Legnica"
    },
    {
        value: 58, desc: "Auchan Lublin Al. Witosa"
    },
    {
        value: 67, desc: "Auchan Piaseczno"
    },
    {
        value: 71, desc: "Auchan Poznań Komorniki"
    },
    {
        value: 72, desc: "Auchan Poznań Swadzim"
    },
    {
        value: 76, desc: "Auchan Rumia"
    },
    {
        value: 78, desc: "Auchan Piaseczno"
    },
    {
        value: 79, desc: "Auchan Rzeszów Krasne"
    },
    {
        value: 82, desc: "Auchan Szczecin Kołbaskowo"
    },
    {
        value: 90, desc: "Auchan Warszawa Modlińska"
    },
    {
        value: 93, desc: "Auchan Warszawa Wola"
    },
    {
        value: 88, desc: "Auchan Wałbrzych"
    },
    {
        value: 95, desc: "Auchan Wrocław Kobierzyce"
    },
    {
        value: 5, desc: "Auchan Łomianki"
    },
    {
        value: 100, desc: "Auchan Żory"
    }
];

const periods = [
    {
        value: '-d',
        desc: "Last day"
    },
    {
        value: '-3d',
        desc: 'Last 3 days'
    },
    {
        value: '-7d',
        desc: 'Last 7 days'
    },
    {
        value: '-14d',
        desc: 'Last 14 days'
    },
    {
        value: '-30d',
        desc: 'Last 30 days'
    }
];

const getPetrolPriceServiceUrl = '/api/auchan-stores/{id}/petrol-prices';

export {petrolStations, periods, getPetrolPriceServiceUrl};