const createdDate = value => {
    if (!value) {
        return '';
    }

    const date = new Date(value.toString());

    // diff in milliseconds
    const diff = new Date() - date;

    // tweet was added less that 1 second
    if (diff < 1000) {
        return '1s ago';
    }

    // convert to seconds
    const seconds = Math.floor(diff / 1000);

    if (seconds < 60) {
        return `${seconds} sec. ago`;
    }

    // convert diff to min
    const mins = Math.floor(diff / 60000);

    if (mins < 60) {
        return `${mins} min. ago`;
    }

    return date.toDateString();
};

const createFilters = (Vue) => {
    Vue.filter('createdDate', createdDate);
};

export default createFilters;
