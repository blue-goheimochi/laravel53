<template>
  <div id="btn-like">
    <button type="button" class="btn btn-secondary btn-like" v-on:click="submit" v-bind:class="{ active: isLiked }"><i class="fa fa-thumbs-o-up fa-fw" aria-hidden="true"></i> いいね！</button>
    <div class="balloon"><p>{{ counter }}</p></div>
  </div>
</template>
<script>
module.exports = {
  data: function () {
    return {
      counter: this.count,
      topicId: this.topic,
      isLiked: this.like
    }
  },
  props: ['count', 'like', 'topic'],
  methods: {
    submit: function(event) {
      var vm = this
      var data = { topic_id: this.topicId }
      var method = this.isLiked ? 'delete' : 'put'
      if( this.isLiked ) {
        this.$http.delete('/topic/like', { params: data }).then((response) => {
          this.likeSuccess(response)
        }, (response) => {
          this.likeError(response)
        });
      } else {
        this.$http.put('/topic/like', data).then((response) => {
          this.likeSuccess(response)
        }, (response) => {
          this.likeError(response)
        });
      }
    },
    likeSuccess: function(response) {
      if( this.isLiked ) {
        this.isLiked = false
        this.counter = parseInt(this.counter) - 1
      } else {
        this.isLiked = true
        this.counter = parseInt(this.counter) + 1
      }
      $(".btn-like").blur()
    },
    likeError: function(response) {
      $(".btn-like").blur()
      cnosole.log(error)
    }
  }
}
</script>