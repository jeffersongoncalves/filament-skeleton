(() => {
    let { animate, delay } = document.currentScript.dataset
    let selector = '.fi-in-entry-content, .fi-in-entry-wrp'

    // Opening/closing an action modal re-renders nothing in the infolist, so it must not blank it.
    // ponytail: an action without a modal also runs through mountAction, so it skips the skeleton too.
    let isModalToggle = (call) => /^(mount|unmount)\w*Action$/.test(call.method)

    document.addEventListener('livewire:init', () => {
        Livewire.hook('commit', ({ component, commit, succeed, fail }) => {
            let calls = commit.calls ?? []

            if (! calls.length || calls.every(isModalToggle)) return
            if (! component.el.querySelector(selector)) return

            // ponytail: overlapping commits on one component end the skeleton at the first response
            let timer = setTimeout(() => component.el.setAttribute('data-fi-skeleton', animate), Number(delay))
            let done = () => {
                clearTimeout(timer)
                component.el.removeAttribute('data-fi-skeleton')
            }

            succeed(done)
            fail(done)
        })
    })
})()
