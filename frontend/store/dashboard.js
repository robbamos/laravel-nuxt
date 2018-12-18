import api from '~/api'


export const getters = {

    menu(state) {

        return [{
                icon: "apps",
                title: "Overview",
                to: "/dashboard"
            },
            {
                icon: "account_box",
                title: "Inspire",
                to: "/dashboard/inspire"
            },

        ];
    },


}
