export default function ({
    store,
    redirect
}) {
    
    const userIsLoggedIn = !!store.state.auth.user

    if (!userIsLoggedIn) {
        redirect('/login')
    }

}