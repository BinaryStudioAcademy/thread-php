import Storage from '@/services/Storage';
import { emptyUser } from '@/services/Normalizer';

export default {
    user: emptyUser(),
    isLoggedIn: Storage.hasToken(),
    token: Storage.getToken(),
};
