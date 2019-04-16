const page = (link, text, className = '') => ({ link, text, className });

export const makePagination = (pagination) => {
    if (pagination == null) return [];

    let pages = [];
    let { current_page, last_page } = pagination;
    let prev_page = current_page - 1;
    let next_page = current_page + 1;
    let prev_class = prev_page < 1 ? 'disabled' : '';
    let next_class = next_page > last_page ? 'disabled' : '';

    pages.push(page(prev_page, '<<', prev_class));

    if (current_page - 3 >= 1) {
        pages.push(page(1, 1));
    }

    if (current_page - 3 > 1) {
        pages.push(page(current_page - 3, '...', 'disabled'));
    }

    if (current_page - 2 >= 1) {
        pages.push(page(current_page - 2, current_page - 2));
    }

    if (prev_page >= 1) {
        pages.push(page(prev_page, prev_page));
    }

    pages.push(page(current_page, current_page, 'disabled'));

    if (next_page <= last_page) {
        pages.push(page(next_page, next_page));
    }

    if (current_page + 2 <= last_page) {
        pages.push(page(current_page + 2, current_page + 2));
    }

    if (current_page + 3 < last_page) {
        pages.push(page(current_page + 3, '...', 'disabled'));
    }

    if (current_page + 3 <= last_page) {
        pages.push(page(last_page, last_page));
    }

    pages.push(page(next_page, '>>', next_class));

    return {
        current_page: pagination.current_page,
        pages,
    };
};
