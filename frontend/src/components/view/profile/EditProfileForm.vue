<template>
    <div class="profile container desktop box">
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child avatar">
                    <p v-if="user.avatar" class="image is-square">
                        <img class="is-rounded" :src="user.avatar">
                    </p>
                    <DefaultAvatar v-else class="image" :user="user" />
                </div>
            </div>
            <div class="tile is-parent is-9">
                <div class="tile is-child">
                    <b-field label="First Name">
                        <b-input v-model="editUser.firstName" />
                    </b-field>
                    <b-field label="Last Name">
                        <b-input v-model="editUser.lastName" />
                    </b-field>
                    <b-field label="Nickname">
                        <b-input v-model="editUser.nickname" />
                    </b-field>
                    <b-field label="Email">
                        <b-input v-model="editUser.email" type="email" />
                    </b-field>
                    <b-button type="is-primary" @click="handleSaveClick">Save</b-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import { emptyUser } from '@/services/Normalizer';
import DefaultAvatar from '@/components/common/DefaultAvatar.vue';
import showStatusToast from '../../mixin/showStatusToast';

export default {
    name: 'EditProfileForm',

    components: {
        DefaultAvatar,
    },

    mixins: [showStatusToast],

    data() {
        return {
            editUser: {
                ...emptyUser()
            },
        };
    },

    created() {
        this.editUser = {
            ...this.user
        };
    },

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
    },

    methods: {
        ...mapActions('profile', ['updateProfile']),

        async handleSaveClick() {
            try {
                await this.updateProfile(this.editUser);

                this.showSuccessMessage('Profile updated.');
            } catch (error) {
                this.showErrorMessage(error.message);
            }
        },
    },
};
</script>

<style scoped>
.profile.container {
    padding: 20px;
}

.avatar {
    padding: 10px;
}
</style>
