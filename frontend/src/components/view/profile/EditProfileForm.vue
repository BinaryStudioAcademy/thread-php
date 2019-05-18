<template>
    <div class="profile container desktop box">
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child avatar">
                    <div class="image">
                        <img v-if="user.avatar" class="image-avatar is-rounded fit" :src="user.avatar">
                        <DefaultAvatar v-else class="default-avatar" :user="user" />
                        <div class="actions">
                            <b-upload
                                class="upload"
                                v-model="image"
                                accept="image/*"
                                @input="uploadAvatar"
                            >
                                <font-awesome-icon icon="upload" size="5x" :style="{ color: 'white' }" />
                            </b-upload>
                        </div>
                    </div>
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
                    <b-button type="is-primary" @click="onSaveClick">Save</b-button>
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
            image: null,
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
        ...mapActions('auth', ['updateProfile', 'updateProfileImage']),

        async onSaveClick() {
            try {
                await this.updateProfile(this.editUser);

                this.showSuccessMessage('Profile updated.');
            } catch (error) {
                this.showErrorMessage(error.message);
            }
        },

        async uploadAvatar() {
            try {
                await this.updateProfileImage(this.image);

                this.showSuccessMessage('Profile image updated.');
            } catch (error) {
                this.showErrorMessage(error.message);
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.profile.container {
    padding: 20px;
}

.avatar {
    padding: 10px;

    .image {
        width: 200px;
        height: 200px;
    }

    .image-avatar, .default-avatar {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: absolute;
        transition: .3s ease;
        opacity: 1;
        cursor: pointer;

        &:hover {
            opacity: 0.3;
        }
    }

    .actions {
        background: black;
        border-radius: 50%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: absolute;
        transition: .3s ease;
        opacity: 0;

        &:hover {
            opacity: 0.8;
        }

        .upload {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
    }
}
</style>
