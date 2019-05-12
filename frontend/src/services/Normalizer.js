// map api response into our custom format

export const userMapper = user => ({ ...user });

export const emptyUser = () => ({
    id: null,
    name: '',
    avatar: '',
});

export const commentMapper = comment => ({
    ...comment,
    authorId: comment.author_id,
    created: comment.created_at,
    updated: comment.updated_at,
    author: userMapper(comment.author),
    // @todo fix backend api
    likesCount: comment.likes_count || 0
});

export const tweetMapper = tweet => ({
    ...tweet,
    imageUrl: tweet.image_url,
    created: tweet.created_at,
    author: userMapper(tweet.author),
    commentsCount: tweet.comments_count
});
