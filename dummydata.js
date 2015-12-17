var app = angular.module("blogApp");

app.service("dummyData", function(){
   this.articleList = [
       {
           edited: "2015-12-10 00:13:41",
           id: 724,
           public: true,
           published: "2015-12-17 00:13:41",
           summary: "This is the short form of the entry. It could be all new or a truncated version of the full text",
           tags: ["blog", "cats", "fun"],
           title: "The title of your blog",
           ts: 1450311221,
           uid: 759
       },
       {
           edited: "2015-12-10 00:13:41",
           id: 724,
           public: true,
           published: "2015-12-17 00:13:41",
           summary: "This is the short form of the entry. It could be all new or a truncated version of the full text",
           tags: ["blog", "fun"],
           title: "The title of your blog",
           ts: 1450311221,
           uid: 759
       },
       {
           edited: "2015-12-10 00:13:41",
           id: 724,
           public: true,
           published: "2015-12-17 00:13:41",
           summary: "This is the short form of the entry. It could be all new or a truncated version of the full text",
           tags: ["blog", "cats", "fun"],
           title: "The title of your blog",
           ts: 1450311221,
           uid: 759
       },
       {
           edited: "2015-12-10 00:13:41",
           id: 724,
           public: true,
           published: "2015-12-17 00:13:41",
           summary: "This is the short form of the entry. It could be all new or a truncated version of the full text",
           tags: ["blog", "cats"],
           title: "The title of your blog",
           ts: 1450311221,
           uid: 759
       },
       {
           edited: "2015-12-10 00:13:41",
           id: 724,
           public: true,
           published: "2015-12-17 00:13:41",
           summary: "This is the short form of the entry. It could be all new or a truncated version of the full text",
           tags: ["blog", "cats", "fun"],
           title: "The title of your blog",
           ts: 1450311221,
           uid: 759
       }
   ]
});