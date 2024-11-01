export default {
	path: "/procurement",
	meta: { requiredAuth: true },
	component: () =>
		import(
			/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/Base.vue"
		),
	children: [
		{
			path: "",
			redirect: { name: "procurement-dashboard" },
		},

		{
			path: "dashboard",
			name: "procurement-dashboard",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/dashboard/index.vue"
				),
		},

		// pagename
		// {
		// 	path: "pagename",
		// 	component: () =>
		// 		import(
		// 			/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/pagename/index.vue"
		// 		),
		// 	children: [
		// 		{
		// 			path: "",
		// 			name: "procurement-pagename",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/pagename/crud/data.vue"
		// 				),
		// 		},

		// 		{
		// 			path: "create",
		// 			name: "procurement-pagename-create",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/pagename/crud/create.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/edit",
		// 			name: "procurement-pagename-edit",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/pagename/crud/edit.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/show",
		// 			name: "procurement-pagename-show",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/pagename/crud/show.vue"
		// 				),
		// 		},
		// 	],
		// },
	],
};
