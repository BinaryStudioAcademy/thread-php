import moment from 'moment';

const createdDate = value => {
    if (!value) {
        return '';
    }

    return moment.utc(value).fromNow();
};

const createFilters = (Vue) => {
    Vue.filter('createdDate', createdDate);
};

export default createFilters;
