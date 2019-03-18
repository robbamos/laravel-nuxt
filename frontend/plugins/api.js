import endpoints from '~/api/endpoints.js';

export default (ctx, inject) => {
    const init = endpoints(ctx.$axios);
    inject('api', init);
}