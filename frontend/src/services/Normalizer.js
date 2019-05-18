// map api response into our custom format

export const userMapper = user => ({
    id: user.id,
    avatar: user.avatar,
    email: user.email,
    nickname: user.nickname,
    firstName: user.first_name,
    lastName: user.last_name,
});

export const emptyUser = () => ({
    id: null,
    avatar: null,
    email: '',
    nickname: '',
    firstName: '',
    lastName: '',
});

export const commentMapper = comment => ({
    id: comment.id,
    body: comment.body,
    authorId: comment.author_id,
    tweetId: comment.tweet_id,
    created: comment.created_at,
    updated: comment.updated_at,
    author: userMapper(comment.author),
});

export const likeMapper = like => ({
    userId: like.user_id
});

export const tweetMapper = tweet => ({
    id: tweet.id,
    text: tweet.text,
    imageUrl: tweet.image_url,
    created: tweet.created_at,
    author: userMapper(tweet.author),
    commentsCount: tweet.comments_count,
    likesCount: tweet.likes_count,
    likes: tweet.likes.map(likeMapper)
});
