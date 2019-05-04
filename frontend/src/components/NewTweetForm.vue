<template>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Add</p>
        </header>

        <section class="modal-card-body">
            <b-field label="Text">
                <b-input
                    type="textarea"
                    v-model="tweet.text"
                />
            </b-field>

            <b-field class="file">
                <b-upload v-model="tweet.image">
                    <a class="button is-primary">
                        <b-icon pack="fa" icon="upload" />
                        <span>Upload image</span>
                    </a>
                </b-upload>
                <span class="file-name" v-if="tweet.image">
                    {{ tweet.image.name }}
                </span>
            </b-field>
        </section>

        <footer class="modal-card-foot">
            <b-button type="is-primary" :disabled="!tweet.text.trim()" @click="save">
                Save
            </b-button>
        </footer>
    </div>
</template>

<script>
export default {
    name: 'NewTweetForm',

    props: {
        onSave: {
            type: Function,
            required: true
        }
    },

    data: () => ({
        tweet: {
            text: '',
            image: null
        }
    }),

    methods: {
        save() {
            this.onSave(this.tweet);
            this.$parent.close();
        }
    }
};
</script>

<style scoped>

</style>
