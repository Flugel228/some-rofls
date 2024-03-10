export type History = {
    history: {
        image: string
        type: number
    }
    types: string[]
    nextHistoriesIds: { id: number }[]
}