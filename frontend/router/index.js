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

		// auction
		{
			path: "auction",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/auction/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-auction",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/auction/crud/data.vue"
						),
				},

				{
					path: ":auction/edit",
					name: "procurement-auction-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/auction/crud/edit.vue"
						),
				},

				{
					path: ":auction/show",
					name: "procurement-auction-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/auction/crud/show.vue"
						),
				},
			],
		},

		// biodata
		{
			path: "biodata",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/biodata/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-biodata",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/biodata/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "procurement-biodata-create",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/biodata/crud/create.vue"
						),
				},

				{
					path: ":biodata/edit",
					name: "procurement-biodata-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/biodata/crud/edit.vue"
						),
				},

				{
					path: ":biodata/show",
					name: "procurement-biodata-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/biodata/crud/show.vue"
						),
				},
			],
		},

		// document
		{
			path: "document",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/document/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-document",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/document/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "procurement-document-create",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/document/crud/create.vue"
						),
				},

				{
					path: ":document/edit",
					name: "procurement-document-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/document/crud/edit.vue"
						),
				},

				{
					path: ":document/show",
					name: "procurement-document-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/document/crud/show.vue"
						),
				},
			],
		},

		// history
		{
			path: "history",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/history/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-history",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/history/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "procurement-history-create",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/history/crud/create.vue"
						),
				},

				{
					path: ":history/edit",
					name: "procurement-history-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/history/crud/edit.vue"
						),
				},

				{
					path: ":history/show",
					name: "procurement-history-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/history/crud/show.vue"
						),
				},
			],
		},

		// report
		{
			path: "report",
			name: "procurement-report",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/report/index.vue"
				),
		},

		// workgroup
		{
			path: "workgroup",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-workgroup",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "procurement-workgroup-create",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup/crud/create.vue"
						),
				},

				{
					path: ":workgroup/edit",
					name: "procurement-workgroup-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup/crud/edit.vue"
						),
				},

				{
					path: ":workgroup/show",
					name: "procurement-workgroup-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup/crud/show.vue"
						),
				},
			],
		},

		// member
		{
			path: "workgroup/:workgroup/member",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup-member/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-member",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup-member/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "procurement-member-create",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup-member/crud/create.vue"
						),
				},

				{
					path: ":member/edit",
					name: "procurement-member-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup-member/crud/edit.vue"
						),
				},

				{
					path: ":member/show",
					name: "procurement-member-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workgroup-member/crud/show.vue"
						),
				},
			],
		},

		// workunit
		{
			path: "workunit",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-workunit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "procurement-workunit-create",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit/crud/create.vue"
						),
				},

				{
					path: ":workunit/edit",
					name: "procurement-workunit-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit/crud/edit.vue"
						),
				},

				{
					path: ":workunit/show",
					name: "procurement-workunit-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit/crud/show.vue"
						),
				},
			],
		},

		// workunit
		{
			path: "workunit/:workunit/officer",
			component: () =>
				import(
					/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit-officer/index.vue"
				),
			children: [
				{
					path: "",
					name: "procurement-officer",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit-officer/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "procurement-officer-create",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit-officer/crud/create.vue"
						),
				},

				{
					path: ":officer/edit",
					name: "procurement-officer-edit",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit-officer/crud/edit.vue"
						),
				},

				{
					path: ":officer/show",
					name: "procurement-officer-show",
					component: () =>
						import(
							/* webpackChunkName: "procurement" */ "@modules/procurement/frontend/pages/workunit-officer/crud/show.vue"
						),
				},
			],
		},
	],
};
